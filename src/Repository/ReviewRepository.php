<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    /**
     * Get reviews date group by days
     *
     * @param array $data
     * @return array
     */
    public function getDayGroup(array $data): array
    {
        if (empty($data) || !array_filter($data)) {
            return [];
        }

        $rows = $this->createQueryBuilder('r')
            ->select(
                'count(r.id) AS review_count',
                'ROUND(AVG(r.score)) AS average_score',
                'DATE_FORMAT(r.createdDate, \'%W\') AS date_group',
                'DAY(r.createdDate) as day')
            ->where('r.createdDate BETWEEN :fromDate AND :toDate')
            ->andWhere('r.hotel = :hotelId')
            ->setParameter('fromDate', $data['fromDate'])
            ->setParameter('toDate', $data['toDate'])
            ->setParameter('hotelId', $data['hotel'])
            ->groupBy('day')
            ->orderBy('r.createdDate', 'ASC')
            ->getQuery()
            ->getResult();

        foreach ($rows as $key => $row) {
            unset($row['day']);
            $rows[$key] = $row;
        }

        return $rows;
    }

    /**
     * Get reviews date group by weeks
     *
     * @param array $data
     * @return array
     */
    public function getWeekGroup(array $data): array
    {
        if (empty($data) || !array_filter($data)) {
            return [];
        }

        $rows = $this->createQueryBuilder('r')
            ->select(
                'count(r.id) AS review_count',
                'ROUND(AVG(r.score)) AS average_score',
                'CONCAT(YEAR(r.createdDate), \'-week \', WEEK(r.createdDate, 2)) AS date_group',
                'WEEK(r.createdDate, 2) AS week'
            )
            ->where('r.createdDate BETWEEN :fromDate AND :toDate')
            ->andWhere('r.hotel = :hotelId')
            ->setParameter('fromDate', $data['fromDate'])
            ->setParameter('toDate', $data['toDate'])
            ->setParameter('hotelId', $data['hotel'])
            ->groupBy('week')
            ->orderBy('r.createdDate', 'ASC')
            ->getQuery()
            ->getResult();


       foreach ($rows as $key => $row) {
           unset($row['week']);
           $rows[$key] = $row;
       }

        return $rows;
    }

    /**
     * Get reviews date group by months
     *
     * @param array $data
     * @return array
     */
    public function getMonthGroup(array $data): array
    {
        if (empty($data) || !array_filter($data)) {
            return [];
        }

        $rows = $this->createQueryBuilder('r')
            ->select(
                'count(r.id) AS review_count',
                'ROUND(AVG(r.score)) AS average_score',
                'DATE_FORMAT(r.createdDate, \'%Y-%m\') AS date_group',
                'YEAR(r.createdDate) as year',
                'MONTH(r.createdDate) as month')
            ->where('r.createdDate BETWEEN :fromDate AND :toDate')
            ->andWhere('r.hotel = :hotelId')
            ->setParameter('fromDate', $data['fromDate'])
            ->setParameter('toDate', $data['toDate'])
            ->setParameter('hotelId', $data['hotel'])
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('r.createdDate', 'ASC')
            ->getQuery()
            ->getResult();

        foreach ($rows as $key => $row) {
            unset($row['year']);
            unset($row['month']);
            $rows[$key] = $row;
        }

        return $rows;
    }
}

